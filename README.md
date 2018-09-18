# Test FB Graph API proxy

## Installing

    git clone git@github.com:stepanov/wh-test-fb-graph-api-proxy.git

    composer install

## Usage

    http://yourdomain.com/fb_graph_api_proxy.php?uri=<valid FB Graph URI or empty>&<valid FB Graph params>

#### Example

    http://yourdomain.com/fb_graph_api_proxy.php?uri=friends&fields=id,name,about,birthday

## Author

* Mikhail Stepanov

## Acknowledgments

* Guzzle - a PHP HTTP client - http://docs.guzzlephp.org
* Facebook PHP SDK - https://developers.facebook.com/docs/reference/php/
