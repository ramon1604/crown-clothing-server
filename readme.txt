Installation
------------

IMPORTANT: CODE PROVIDED FOR LINUX/MAC PLATFORMS. NOT WINDOWS

1- Create php folder in domain root.
2- Copy all files to php folder
3- Create environment variable (.env)
4- Add following information to .env file:

STRIPE_PUBLISHABLE_KEY="stripe publishable key here"
STRIPE_SECRET_KEY="stripe secret key here"
STRIPE_SUCCESS_URL="https://<yourdomain>/success"
STRIPE_CANCEL_URL="https://<yourdomain>/cancel"

Note: It can be domain or subdomain. It has to be from where you
are publishing your website.

5- Run -composer install- from terminal to create vendor folder with libraries.
