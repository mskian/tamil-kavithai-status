# தமிழ் கவிதை Status  

"தமிழ் கவிதை நிலை – இங்கே நான் எனது பிடித்த தமிழ் பொன்மொழிகளையும் கவிதைகளையும் பகிர்கிறேன் (Tamil Kavithai Status - Here i Share My Favourite Tamil Quotes and Kavithai.)"  

## Content Database

- Add kavithai in `content/quotes.md` Check the Below Format

```md
# Kavithai 1
slug: kavithai-1
content: "உழைப்பின் மேல் நம்பிக்கையை வைத்திருந்தால், வெற்றி உங்கள் கையிலிருக்கும்."
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

## LICENSE  

MIT
