# New ports collection makefile for:	lightboard
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	lightboard
PORTVERSION=	7.0
CATEGORIES=	sakura-bbs

MAINTAINER=	support@sakura.a.djp
COMMENT=	${BASEURL}/${CGISUBDIR}/light.cgi
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

SED_CGI=	-e "s!%%REGISTKEY%%!${REGISTKEY}!g" \
		-e "s!%%PASTKEY%%!${PASTKEY}!g" \
		-e "s!%%PASTMAX%%!${PASTMAX}!g"
.if defined(SENDMAILYN) && ${SENDMAILYN} == "yes"
SED_CGI+=	-e "s!%%SENDMAILPATH%%!/usr/sbin/sendmail!g"
.else
SED_CGI+=	-e "s!%%SENDMAILPATH%%!!g"
.endif

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${CP} -nRpP ${WRKSRC}/* "${INDEXDIR}"
	@${SED} ${SED_CGI} ${WRKSRC}/init.cgi |\
		${NKF} -s > "${INDEXDIR}/init.cgi"

.include "sakura.port.mk"
.include "bsd.port.mk"
