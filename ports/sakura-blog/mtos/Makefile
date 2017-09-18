# New ports collection makefile for:	mtos
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	mtos
PORTVERSION=	5.2.13
CATEGORIES=	sakura-blog
DISTNAME=	MTOS-${PORTVERSION}-ja

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/mt.cgi
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
SUB_FILES=	pkg-message pkg-deinstall mt-config.cgi
SUB_LIST+=	CGISUBDIR="${CGISUBDIR}" \
		CGIDIR="${CGIDIR}" \
		INDEXDIR="${INDEXDIR}" \
		DOMAIN="${DOMAIN}" \
		DBNAME="${DBNAME}" \
		DBUSER="${DBUSER}" \
		DBPASS="${DBPASS}" \
		DBHOST="${DBHOST}"

pre-install:
	@cd ${WRKSRC} && ${FIND} -s * -type f |\
		${SED} -e 's|^|%%CGIDIR%%/|' > ${PLIST}
	@cd ${WRKSRC} && ${FIND} -d * -type d |\
		${SED} -e 's|^|@dirrm %%CGIDIR%%/|' >> ${PLIST}
	@${ECHO_CMD} '@dirrm %%CGIDIR%%' >> ${PLIST}

do-install:
	@${INSTALL} -d -m 705 "${INDEXDIR}"
	@${CP} -RpP ${WRKSRC}/* "${INDEXDIR}"
	@if [ ! -f "${INDEXDIR}/mt-config.cgi" ]; then \
		${INSTALL} -m 600 ${WRKDIR}/mt-config.cgi "${INDEXDIR}" ; \
	fi

.include "sakura.port.mk"
.include "bsd.port.mk"
