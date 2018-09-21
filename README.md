# Etsy On Bolt CMS

## Setup

1. `composer install` in the root of the project.
1. Save `.env.dist` as `.env`
1. In `.env`, update the `ETSY_API_KEY` to your [Etsy API key][1] and `ETSY_SHOP_NAME` to your Etsy shop name. 

## Running the Demo

1. Run `php bin/console server:run` in the project root.
1. browse to [http://127.0.0.1:8000][2]
1. Navigate to `/products/list`.

[1]: https://www.etsy.com/developers/your-apps
[2]: http://127.0.0.1:8000