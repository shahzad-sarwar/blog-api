# blog-api

## Clone

cd dir

composer install

cp .env.example .env

php artisan key:generate

put STORAGE_DISK=public in .env
set APP_URL in .env

php artisan migrate --seed (to seed with 3 Users with different Roles admin, manager & user)

admin@blog.com
password

manager@blog.com
password

user@blog.com
password

php artisan config:cache
php artisan cache:clear

API's endpoints

Accept: Application/Json
Content-Type: Application/Json

/api/register

params: name, email, password, (base64) image (default user role will be added)

/api/login

params: email, password

/api/categories
[GET, SHOW, POST, PUT/PATCH {id}, DELETE {id}] only for admins.

params: name, slug

/api/categories/{slug}
it will display the categories, with related posts

/api/posts
[GET, SHOW, POST, PUT/PATCH {id}, DELETE {id}] based on authentication

params: title, slug, body, image (base64), meta_title(nullable), meta_keywords(nullable), meta_description(nullable)
categories (required | array)

e.g

	"categories": [
		{
			"id": 1
		},
		{
			"id": 2
		}
	]

/api/posts/{slug}
will display post

/api/admins/roles
[GET] roles id

/api/admins/users
[GET, SHOW {id}, POST, PUT/PATCH {id}, DELETE {id}] only for admins.

params: name, email, password, image(nullable), role_id


