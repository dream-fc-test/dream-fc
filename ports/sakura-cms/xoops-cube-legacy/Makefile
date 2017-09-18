# New ports collection makefile for:	xoops-cube-legacy
# Date created:		2013-06-17
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	xoops-cube-legacy
PORTVERSION=	2.2.1
CATEGORIES=	sakura-cms
DISTNAME=	${PORTNAME}-${PORTVERSION}

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/index.php
WRKSRC=		${WRKDIR}/${DISTNAME}

# sakura-ports setting
INDEXDIR=	"${PREFIX}/${CGIDIR}"
CGIDIR=		"${DOCROOT}/${CGISUBDIR}"
NO_BUILD=	yes
FORCE_PKG_REGISTER=	yes
PLIST_SUB+=	CGIDIR="${CGIDIR}"

# pkg-sakura configure
CGISUBDIR?=	${PORTNAME}

# application setting
SUB_FILES=	pkg-message pkg-deinstall mainfile.php install_nextStep.inc.php
SUB_LIST+=	CGISUBDIR="${CGISUBDIR}" \
		CGIDIR="${CGIDIR}" \
		INDEXDIR="${INDEXDIR}" \
		DOMAIN="${DOMAIN}" \
		DBNAME="${DBNAME}" \
		DBUSER="${DBUSER}" \
		DBPASS="${DBPASS}" \
		DBHOST="${DBHOST}" \
		DBSALT="${DBSALT}" \
		DBPREFIX="${DBPREFIX}"

post-extract:
	@cd ${WRKSRC}/html && ${MV} -f install ${WRKDIR}
	@cd ${WRKSRC}/html && ${RM} -f mainfile.php

pre-install:
	@cd ${WRKSRC}/html && ${FIND} -s * -type f |\
		${SED} -e 's|^|%%CGIDIR%%/|' > ${PLIST}
	@cd ${WRKSRC}/html && ${FIND} -d * -type d |\
		${SED} -e 's|^|@dirrm %%CGIDIR%%/|' >> ${PLIST}
	@${ECHO_CMD} '@dirrm %%CGIDIR%%' >> ${PLIST}

do-install:
	@${INSTALL} -d -m 705 "${INDEXDIR}"
	@${CP} -RpP ${WRKSRC}/html/* "${INDEXDIR}"
	@if [ ! -f "${INDEXDIR}/mainfile.php" ]; then \
		cd ${WRKDIR} && \
		${CP} -RpP install_nextStep.inc.php install/wizards && \
		${CP} -RpP mainfile.php install "${INDEXDIR}" ; \
	fi
	@${CHMOD} -h a-wx "${INDEXDIR}/mainfile.php"

.include "sakura.port.mk"
.include "bsd.port.mk"
