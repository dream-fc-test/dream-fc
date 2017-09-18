# New ports collection makefile for:	wforum
# Date created:		2010-01-22
# Whom:			SAKURA Internet Inc. <support@sakura.ad.jp>
#
# $FreeBSD$
#

PORTNAME=	wforum
PORTVERSION= 	6.42
CATEGORIES=	sakura-bbs

MAINTAINER=	support@sakura.ad.jp
COMMENT=	${BASEURL}/${CGISUBDIR}/wforum.cgi
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
		-e "s!%%TCOLER%%!${TCOLER}!g" \
		-e "s!%%PASSWD%%!${PASSWD}!g" \
		-e "s!%%MAXARC%%!${MAXARC}!g" \
		-e "s!%%HOMEURL%%!${HOMEURL}!g" \
		-e "s!%%AUTOLINK%%!${AUTOLINK}!g" \
		-e "s!%%NEW_TIME%%!${NEW_TIME}!g" \
		-e "s!%%SORTCNT%%!${SORTCNT}!g" \
		-e "s!%%P_TREE%%!${P_TREE}!g" \
		-e "s!%%SUB_LENGTH%%!${SUB_LENGTH}!g" \
		-e "s!%%IN_EMAIL%%!${IN_EMAIL}!g" \
		-e "s!%%TOP_SORT%%!${TOP_SORT}!g" \
		-e "s!%%BOT_RES%%!${BOT_RES}!g" \
		-e "s!%%TREEHEAD%%!${TREEHEAD}!g" \
		-e "s!%%PASTKEY%%!${PASTKEY}!g" \
		-e "s!%%MAX_LINE%%!${MAX_LINE}!g" \
		-e "s!%%JP_WD%%!${JP_WD}!g" \
		-e "s!%%REGCTL%%!${REGCTL}!g" \
		-e "s!%%WAITTIME%%!${WAITTIME}!g"

do-install:
	@${INSTALL} -d -m 701 "${INDEXDIR}"
	@${CP} -nRpP ${WRKSRC}/* "${INDEXDIR}"
	@${SED} ${SED_CGI} ${WRKSRC}/init.cgi |\
		${NKF} -s > "${INDEXDIR}/init.cgi"

.include "sakura.port.mk"
.include "bsd.port.mk"
