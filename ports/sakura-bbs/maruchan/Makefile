# New ports collection makefile for:	maruchan
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	maruchan
PORTVERSION=	0.96
CATEGORIES=	sakura-bbs

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/maruchan.cgi
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

SED_CGI=	-e "s!%%BBSSELECT%%!${BBSSELECT}!g" \
		-e "s!%%LOGFILE2%%!${LOGFILE2}!g" \
		-e "s!%%DATAMAX%%!${DATAMAX}!g" \
		-e "s!%%PAGEMAX%%!${PAGEMAX}!g" \
		-e "s!%%PASSWORD%%!${PASSWORD}!g" \
		-e "s!%%TAG%%!${TAG}!g" \
		-e "s!%%RESFLAG%%!${RESFLAG}!g" \
		-e "s!%%AGENTFLAG%%!${AGENTFLAG}!g" \
		-e "s!%%HOSTFLAG%%!${HOSTFLAG}!g" \
		-e "s!%%BUTTONFLAG%%!${BUTTONFLAG}!g"

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${CP} -nRpP ${WRKSRC}/* "${INDEXDIR}"
	@${SED} ${SED_CGI} ${WRKSRC}/maruchan.cgi |\
		${NKF} -s > "${INDEXDIR}/maruchan.cgi"

.include "sakura.port.mk"
.include "bsd.port.mk"
