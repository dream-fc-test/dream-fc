PKG_DBDIR=	${HOME}/db/pkg
PORTSDIR=	${HOME}/ports
LOCALBASE=	${HOME}
PORTEPOCH=	${SAKURADUP}
INSTALL_AS_USER=	yes
DISABLE_VULNERABILITIES=	yes
VALID_CATEGORIES+=	${CATEGORIES}
NOPORTDOCS=	yes
NOPORTEXAMPLES=	yes
NOPORTDATA=	yes
REINPLACE_ARGS=	-i ''
DISABLE_LICENSES=	yes
NKF?=		/usr/local/bin/nkf
.if exists(/usr/bin/htpasswd)
HTPASSWD?=	/usr/bin/htpasswd
.elif exists(/usr/local/bin/htpasswd)
HTPASSWD?=	/usr/local/bin/htpasswd
.endif
