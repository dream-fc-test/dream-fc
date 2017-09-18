# New ports collection makefile for:	txcount
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	txcount
PORTVERSION=	2.0
CATEGORIES=	sakura-counter

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/txcount.cgi
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
SUB_FILES=	pkg-message pkg-deinstall
SUB_LIST+=	CGISUBDIR="${CGISUBDIR}" \
		CGIDIR="${CGIDIR}" \
		INDEXDIR="${INDEXDIR}" \
		DOMAIN="${DOMAIN}" \
		CGIROOT="${CGIROOT}"

SED_CGI=	-e "s:%%DIGIT%%:${DIGIT}:g" \
		-e "s:%%DIVIDE%%:${DIVIDE}:g" \
		-e "s:%%IP_CHECK%%:${IP_CHECK}:g"

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${CP} -nRpP ${WRKSRC}/* "${INDEXDIR}"
	@${SED} ${SED_CGI} ${WRKSRC}/txcount.cgi |\
		${NKF} -s > "${INDEXDIR}/txcount.cgi"

.include "sakura.port.mk"
.include "bsd.port.mk"
