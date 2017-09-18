# New ports collection makefile for:	kakikomitai
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	kakikomitai
PORTVERSION=	0.97
CATEGORIES=	sakura-bbs

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/kakikomitai.cgi
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

SED_CGI=	-e "s!%%TITLE%%!${TITLE}!g" \
		-e "s!%%TITLESET%%!${TITLESET}!g" \
		-e "s!%%TITLESET2%%!${TITLESET2}!g" \
		-e "s!%%URL_TARGET%%!${URL_TARGET}!g" \
		-e "s!%%RENTALSERVER_DOMAIN%%!${RENTALSERVER_DOMAIN}!g" \
		-e "s!%%DATAMAX%%!${DATAMAX}!g" \
		-e "s!%%PAGEMAX%%!${PAGEMAX}!g" \
		-e "s!%%PASSWORD%%!${PASSWORD}!g" \
		-e "s!%%TAG%%!${TAG}!g" \
		-e "s!%%HOSTFLAG%%!${HOSTFLAG}!g" \
		-e "s!%%GIF_FLG%%!${GIF_FLG}!g" \
		-e "s!%%MAXWORD%%!${MAXWORD}!g" \
		-e "s!%%RESSW%%!${RESSW}!g" \
		-e "s!%%RESFLAG%%!${RESFLAG}!g" \
		-e "s!%%RES_GIF%%!${RES_GIF}!g" \
		-e "s!%%ROW%%!${ROW}!g" \
		-e "s!%%COL%%!${COL}!g" \
		-e "s!%%TABL_SZ%%!${TABL_SZ}!g" \
		-e "s!%%RENCHAN%%!${RENCHAN}!g"

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${CP} -nRpP ${WRKSRC}/* "${INDEXDIR}"
	@${SED} ${SED_CGI} ${WRKSRC}/kakikomitai.cgi |\
		${NKF} -s > "${INDEXDIR}/kakikomitai.cgi"

.include "sakura.port.mk"
.include "bsd.port.mk"
