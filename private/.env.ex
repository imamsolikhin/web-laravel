APP_NAME=HPI-Management
APP_ENV=local
APP_KEY=base64:C9rX62NEI0C7UGD4UjN6Bu/ImKB4VtQQR9VW/rnEFV4=
APP_DEBUG=true
APP_URL=http://localhost/apps-sys/public/
APP_COMPANY=JKT
APP_BRANCH=JKT-B

LOG_CHANNEL=slack
LOG_SLACK_WEBHOOK_URL=https://hooks.slack.com/services/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

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_hpi
DB_USERNAME=mrpuser
DB_PASSWORD=admin

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"


RLM_IKB_NOC=http://localhost/web-noc/api-ticket-noc/public/api/v1
IKB_OLT_NOC=http://localhost/web-noc/api-olt-noc/public/api/v1
IKB_TLN_NOC=http://localhost/web-noc/api-telnet-noc/public/api/v1
IKB_AST_NOC=http://localhost/web-noc/api-asset-noc/public/api/v1
