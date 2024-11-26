# தமிழ் கவிதை Status  

[![Publish on Server](https://github.com/mskian/tamil-kavithai-status/actions/workflows/deploy.yml/badge.svg)](https://github.com/mskian/tamil-kavithai-status/actions/workflows/deploy.yml)  

"தமிழ் கவிதை நிலை – இங்கே நான் எனது பிடித்த தமிழ் பொன்மொழிகளையும் கவிதைகளையும் பகிர்கிறேன் (Tamil Kavithai Status - Here i Share My Favourite Tamil Quotes and Kavithai.)"  

## Built Using

- PHP
- Markdown
- HTML
- Bulma CSS
- SEO Meta tags  
- Pagination  
- 404 Page  
- Dynamic Sitemap and Robots.txt  

## Content Database

- Add kavithai in `content` Check the Below Format
- keep File name as `quote1.md, quote2.md etc...`

```md
# Kavithai 1
slug: kavithai-1
content: "இன்று செய்யும் முயற்சியே நாளைய வெற்றியை தீர்மானிக்கிறது"
```

## usage

- `index.php` - Home page and Pagination
- `kavithai.php` - Single Post Page

```php

## Pagination
http://localhost:6022/?page=1

## Single Post Page
http://localhost:6022/kavithai.php?slug=kavithai-1
```

- `includes` Folder having the Code Related to Header, Footer, Single Post and Functions  

## SEO Friendly URL

- SEO Friendly Single Post URL

```htaccess
RewriteEngine On
RewriteRule ^k/([a-zA-Z0-9\-]+)$ kavithai.php?slug=$1 [L,QSA]
```

```md
http://localhost:6022/k/kavithai-1
```

## Deployment

- Server with PHP 7.4 to PHP 8.X.X Support
- Apache or Nginx or Lightspeed Server

## LICENSE  

MIT
