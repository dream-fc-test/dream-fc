#-*- mode: Fundamental; tab-width: 4; -*-
# ex:ts=4
#
# bsd.gcc.mk - Support for smarter USE_GCC usage.
#
# Created by: Edwin Groothuis <edwin@freebsd.org>
#
# For port developers:
# If your port needs a specific (minimum) version of GCC, you can easily
# specify that with a "USE_GCC=" statement.  Unless absolutely necessary
# do so by specifying "USE_GCC=X.Y+" which requests at least GCC version
# X.Y.  To request a specific version omit the trailing + sign.  Use of
# a Fortran compiler is declared by the USE_FORTRAN knob, not USE_GCC.
#
# Examples:
#   USE_GCC=	4.2+		# port requires GCC 4.2 or later.
#   USE_GCC=	4.5			# port requires GCC 4.5.
#
# If your port needs a Fortran compiler, please specify that with the
# USE_FORTRAN= knob.  Here is the list of options for that knob:
#
#   USE_FORTRAN=	yes		# use gfortran45 (lang/gcc45)
#   USE_FORTRAN=	g77		# use g77-34 (lang/gcc34; FreeBSD>=7)
#							# or system f77 (/usr/bin/f77; FreeBSD<=6)
#   USE_FORTRAN=	ifort	# use the Intel compiler (lang/ifc)
#
# Due to object file incompatiblity between Fortran compilers, we strongly
# recommend to use only one of them on any system.
#
# If you are wondering what your port exactly does, use "make test-gcc"
# to see some debugging.
#
# $FreeBSD: ports/Mk/bsd.gcc.mk,v 1.51 2011/05/04 22:33:13 flz Exp $
#

GCC_Include_MAINTAINER=		gerald@FreeBSD.org

# All GCC versions supported by the ports framework.  Keep them in
# ascending order and in sync with the table below. 
GCCVERSIONS=	030402 040200 040400 040500 040600

# The first field if the OSVERSION in which it appeared in the base.
# The second field is the OSVERSION in which it disappeared from the base.
# The third field is the version as USE_GCC would use.
GCCVERSION_030402=	502126 700042 3.4
GCCVERSION_040200=	700042 999999 4.2
GCCVERSION_040400=	999999 999999 4.4
GCCVERSION_040500=	999999 999999 4.5
GCCVERSION_040600=	999999 999999 4.6

#
# No configurable parts below this.
#

# Extract the fields from GCCVERSION_...
.for v in ${GCCVERSIONS}
. for j in ${GCCVERSION_${v}}
.  if !defined(_GCCVERSION_${v}_L)
_GCCVERSION_${v}_L=	${j}
.  elif !defined(_GCCVERSION_${v}_R)
_GCCVERSION_${v}_R=	${j}
.  elif !defined(_GCCVERSION_${v}_V)
_GCCVERSION_${v}_V=	${j}
.  endif
. endfor
.endfor

# bsd.gcc.mk can also be used for primarily requesting a Fortran compiler.
# If we are using GCC we still define whatever we'd usually do for C and
# C++ as well.

.if defined (USE_FORTRAN)

# The default case, with a current lang/gcc port.
. if ${USE_FORTRAN} == yes
_USE_GCC:=	4.5
FC:=	gfortran45
F77:=	gfortran45

# Intel Fortran compiler from lang/ifc.
. elif ${USE_FORTRAN} == ifort
BUILD_DEPENDS+=	${LOCALBASE}/intel_fc_80/bin/ifort:${PORTSDIR}/lang/ifc
RUN_DEPENDS+=	${LOCALBASE}/intel_fc_80/bin/ifort:${PORTSDIR}/lang/ifc
FC:=	${LOCALBASE}/intel_fc_80/bin/ifort
F77:=	${LOCALBASE}/intel_fc_80/bin/ifort

# In some case we want to use g77 from lang/gcc34 (FreeBSD>=7) or f77
# (FreeBSD<=6).
. elif ${USE_FORTRAN} == g77
_USE_GCC:=	3.4
FC:=	g77-34
F77:=	g77-34
. else
IGNORE=	specifies unknown value "${USE_FORTRAN}" for USE_FORTRAN
. endif

CONFIGURE_ENV+=	F77="${F77}" FC="${FC}" FFLAGS="${FFLAGS}"
MAKE_ENV+=		F77="${F77}" FC="${FC}" FFLAGS="${FFLAGS}"
.endif


.if defined(USE_GCC)

# See if we can use a later version
_USE_GCC:=	${USE_GCC:S/+//}
.if ${USE_GCC} != ${_USE_GCC}
_GCC_ORLATER:=	true
.endif

# Check if USE_GCC points to a valid version.
.for v in ${GCCVERSIONS}
. for j in ${GCCVERSION_${v}}
.  if ${_USE_GCC}==${j}
_GCCVERSION_OKAY=	true;
.  endif
. endfor
.endfor

.if !defined(_GCCVERSION_OKAY)
IGNORE=	Unknown version of GCC specified (USE_GCC=${USE_GCC})
.endif

#
# Determine current GCCVERSION
#
.for v in ${GCCVERSIONS}
. if exists(${LOCALBASE}/bin/gcc${_GCCVERSION_${v}_V:S/.//})
_GCC_FOUND${v}=	port
. endif
. if ${OSVERSION} >= ${_GCCVERSION_${v}_L} && ${OSVERSION} < ${_GCCVERSION_${v}_R}
_GCCVERSION:=		${v}
_GCC_FOUND${v}:=	base
. endif
.endfor
.if !defined(_GCCVERSION)
IGNORE=		Couldn't find your current GCCVERSION (OSVERSION=${OSVERSION})
.endif

#
# If the GCC package defined in USE_GCC does not exist, but a later
# version is allowed (for example 3.4+), see if there is a later.
# First check if the base installed version is good enough, otherwise
# get the first available version.
#
.if defined(_GCC_ORLATER)
. for v in ${GCCVERSIONS}
.  if ${_USE_GCC} == ${_GCCVERSION_${v}_V}
_GCC_MIN1:=	true
.  endif
.  if defined(_GCC_MIN1) && defined(_GCC_FOUND${v}) && ${_GCC_FOUND${v}}=="base" && !defined(_GCC_FOUND)
_GCC_FOUND:=	${_GCCVERSION_${v}_V}
.  endif
. endfor
. for v in ${GCCVERSIONS}
.  if ${_USE_GCC} == ${_GCCVERSION_${v}_V}
_GCC_MIN2:=	true
.  endif
.  if defined(_GCC_MIN2) && defined(_GCC_FOUND${v}) && !defined(_GCC_FOUND)
_GCC_FOUND:=	${_GCCVERSION_${v}_V}
.  endif
. endfor
.endif
.if defined(_GCC_FOUND)
_USE_GCC:=${_GCC_FOUND}
.endif

.endif # defined(USE_GCC)


.if defined(_USE_GCC)
# A concrete version has been selected.  Determine if the installed OS 
# features this version in the base, and if not then set proper ports
# dependencies, CC, CXX, CPP, and flags.
.for v in ${GCCVERSIONS}
. if ${_USE_GCC} == ${_GCCVERSION_${v}_V}
.  if ${OSVERSION} < ${_GCCVERSION_${v}_L} || ${OSVERSION} > ${_GCCVERSION_${v}_R}
V:=			${_GCCVERSION_${v}_V:S/.//}
_GCC_BUILD_DEPENDS:=	gcc${V}
_GCC_PORT_DEPENDS:=	gcc${V}
CC:=			gcc${V}
CXX:=			g++${V}
CPP:=			cpp${V}
.   if ${_USE_GCC} != 3.4
CFLAGS+=		-Wl,-rpath=${LOCALBASE}/lib/${_GCC_BUILD_DEPENDS}
LDFLAGS+=		-Wl,-rpath=${LOCALBASE}/lib/${_GCC_BUILD_DEPENDS}
.   endif
.  endif
. endif
.endfor
.undef V

.if defined(_GCC_BUILD_DEPENDS)
BUILD_DEPENDS+=	${_GCC_PORT_DEPENDS}:${PORTSDIR}/lang/${_GCC_BUILD_DEPENDS}
. if ${_USE_GCC} != 3.4
RUN_DEPENDS+=	${_GCC_PORT_DEPENDS}:${PORTSDIR}/lang/${_GCC_BUILD_DEPENDS}
.  if ${_USE_GCC} != 4.2
# Later GCC ports already depend on binutils; make sure whatever we
# build leverages this as well.
USE_BINUTILS=	yes
.  endif
. endif
.endif
.endif # defined(_USE_GCC)


test-gcc:
	@echo USE_GCC=${USE_GCC}
	@echo USE_FORTRAN=${USE_FORTRAN}
.if defined(USE_GCC)
.if defined(_GCC_ORLATER)
	@echo Port can use later versions.
.else
	@echo Port cannot use later versions.
.endif
.for v in ${GCCVERSIONS}
	@echo -n "GCC version: ${_GCCVERSION_${v}_V} "
.if defined(_GCC_FOUND${v})
	@echo -n "(${_GCC_FOUND${v}}) "
.endif
	@echo "- OSVERSION from ${_GCCVERSION_${v}_L} to ${_GCCVERSION_${v}_R}"
#	@echo ${v} - ${_GCC_FOUND${v}} - ${_GCCVERSION_${v}_L} to ${_GCCVERSION_${v}_R} - ${_GCCVERSION_${v}_V}
.endfor
	@echo Using GCC version ${_USE_GCC}
.endif
	@echo CC=${CC} - CXX=${CXX} - CPP=${CPP} - CFLAGS=\"${CFLAGS}\"
	@echo F77=${F77} - FC=${FC} - FFLAGS=\"${FFLAGS}\"
	@echo LDFLAGS=\"${LDFLAGS}\"
	@echo "BUILD_DEPENDS=${BUILD_DEPENDS}"
	@echo "RUN_DEPENDS=${RUN_DEPENDS}"
