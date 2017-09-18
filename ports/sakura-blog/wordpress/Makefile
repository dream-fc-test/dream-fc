# New ports collection makefile for:	wordpress
# Date created:		2010-03-01
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	wordpress
PORTVERSION=	4.8
CATEGORIES=	sakura-blog
DISTNAME=	${PORTNAME}-${PORTVERSION}-ja

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
SUB_FILES=	pkg-message pkg-deinstall wp-config.php
SUB_LIST+=	CGISUBDIR="${CGISUBDIR}" \
		CGIDIR="${CGIDIR}" \
		INDEXDIR="${INDEXDIR}" \
		DOMAIN="${DOMAIN}" \
		DBNAME="${DBNAME}" \
		DBUSER="${DBUSER}" \
		DBPASS="${DBPASS}" \
		DBHOST="${DBHOST}" \
		DBPREFIX="${DBPREFIX}"

pre-install:
	@cd ${WRKSRC} && ${FIND} -s * -type f |\
		${SED} -e 's|^|%%CGIDIR%%/|' > ${PLIST}
	@cd ${WRKSRC} && ${FIND} -d * -type d |\
		${SED} -e 's|^|@dirrm %%CGIDIR%%/|' >> ${PLIST}
	@${ECHO_CMD} '@dirrm %%CGIDIR%%' >> ${PLIST}

do-install:
	@${INSTALL} -d -m 705 "${INDEXDIR}"
	@${CP} -RpP ${WRKSRC}/* "${INDEXDIR}"
	@${CP} -p ${WRKSRC}/.htaccess "${INDEXDIR}"
	@if [ ! -f "${INDEXDIR}/wp-config.php" ]; then \
		${NKF} -w ${WRKDIR}/wp-config.php > "${INDEXDIR}/wp-config.php" ; \
	fi

.include "sakura.port.mk"
.include "bsd.port.mk"
