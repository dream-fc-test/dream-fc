# New ports collection makefile for:	tdiary
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	tdiary
PORTVERSION=	3.0.2
CATEGORIES=	sakura-diary
DISTNAME=	tdiary-full-${PORTVERSION}

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/index.rb
WRKSRC=		${WRKDIR}/tdiary-${PORTVERSION}
RUBY=		/usr/local/bin/ruby

# sakura-ports setting
INDEXDIR=	"${PREFIX}/${CGIDIR}"
DATADIR=	"${INDEXDIR}/data"
CGIDIR=		"${DOCROOT}/${CGISUBDIR}"
NO_BUILD=	yes
FORCE_PKG_REGISTER=	yes
PLIST_SUB+=	CGIDIR="${CGIDIR}"

# pkg-sakura configure
CGISUBDIR?=	${PORTNAME}

# application setting
SUB_FILES=	pkg-message pkg-deinstall tdiary.conf \
		dot.htaccess data.htaccess
SUB_LIST+=	CGISUBDIR="${CGISUBDIR}" \
		CGIDIR="${CGIDIR}" \
		DATADIR="${DATADIR}" \
		INDEXDIR="${INDEXDIR}" \
		DOMAIN="${DOMAIN}" \
		CGIROOT="${CGIROOT}" \
		HTUSER="${HTUSER}" \
		YOURNAME="${YOURNAME}" \
		YOURMAIL="${YOURMAIL}"

pre-install:
	@-${RM} -rf "${INDEXDIR}/plugin"
	@cd ${WRKSRC} && ${FIND} -s * -type f |\
		${SED} -e 's|^|%%CGIDIR%%/|' > ${PLIST}
	@cd ${WRKSRC} && ${FIND} -d * -type d |\
		${SED} -e 's|^|@dirrm %%CGIDIR%%/|' >> ${PLIST}
	@${ECHO_CMD} '@dirrm %%CGIDIR%%' >> ${PLIST}

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${INSTALL} -d -m 700 "${DATADIR}"
	@${CP} -RpP ${WRKSRC}/* "${INDEXDIR}"
	@if [ ! -f "${INDEXDIR}/tdiary.conf" ]; then \
		${INSTALL} -m 600 ${WRKDIR}/tdiary.conf "${INDEXDIR}" ; \
		${INSTALL} -m 604 ${WRKDIR}/dot.htaccess "${INDEXDIR}/.htaccess" ; \
		${INSTALL} -m 604 ${WRKDIR}/data.htaccess "${DATADIR}/.htaccess" ; \
	fi
	@${HTPASSWD} -bcm "${INDEXDIR}/.htpasswd" "${HTUSER}" "${PASSWD}"
	@${CP} -pP "${INDEXDIR}/tdiary.conf" "${INDEXDIR}/tdiary.conf.old"
	@${NKF} -w "${INDEXDIR}/tdiary.conf.old" > "${INDEXDIR}/tdiary.conf"

.include "sakura.port.mk"
.include "bsd.port.mk"
