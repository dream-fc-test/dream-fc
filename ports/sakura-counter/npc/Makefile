# New ports collection makefile for:	npc
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	npc
PORTVERSION=	0.83
CATEGORIES=	sakura-counter

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/npc.cgi
WRKSRC=		${WRKDIR}/${DISTNAME}/src

# sakura-ports setting
INDEXDIR=	"${PREFIX}/${CGIDIR}"
CGIDIR=		"${DOCROOT}/${CGISUBDIR}"
FORCE_PKG_REGISTER=	yes
PLIST_SUB+=	CGIDIR="${CGIDIR}"
MAKE_ARGS=	INDEX_DIR="${INDEXDIR}"

# pkg-sakura configure
CGISUBDIR?=	${PORTNAME}

# application setting
SUB_FILES=	pkg-message pkg-deinstall npc.idx dot.htaccess
SUB_LIST+=	CGISUBDIR="${CGISUBDIR}" \
		CGIDIR="${CGIDIR}" \
		INDEXDIR="${INDEXDIR}" \
		DOMAIN="${DOMAIN}" \
		CGIROOT="${CGIROOT}"

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${INSTALL} -m 604 /dev/null "${INDEXDIR}/index.html"
	@${INSTALL} -m 604 ${WRKDIR}/dot.htaccess "${INDEXDIR}/.htaccess"
	@${CP} -np ${WRKDIR}/npc.idx "${INDEXDIR}"
	@${INSTALL} -m 700 ${WRKSRC}/npc.cgi "${INDEXDIR}"

.include "sakura.port.mk"
.include "bsd.port.mk"
