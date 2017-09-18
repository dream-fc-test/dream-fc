# New ports collection makefile for:	postmail
# Date created:		2010-03-01
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	postmail
PORTVERSION= 	6.71
CATEGORIES=	sakura-form

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/postmail.cgi
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

SED_CGI=	-e "s:%%MAILTO%%:${MAILTO}:g" \
		-e "s:%%MAXFIELD%%:${MAXFIELD}:g" \
		-e "s:%%SUBJECT%%:${SUBJECT}:g" \
		-e "s!%%BACKURL%%!${BACKURL}!g" \
		-e "s:%%BLOCKPOST%%:${BLOCKPOST}:g"

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${CP} -nRpP ${WRKSRC}/* "${INDEXDIR}"
	@${SED} ${SED_CGI} ${WRKSRC}/init.cgi |\
		${NKF} -s > "${INDEXDIR}/init.cgi"

.include "sakura.port.mk"
.include "bsd.port.mk"
