User-agent: *
Disallow: */index.php
Disallow: *?*
Disallow: *&*
Disallow: /storage/
Disallow: /dashboard/
Disallow: /front/
Disallow: /vendor/

User-Agent: Yandex
Disallow: */index.php
Disallow: *?*
Disallow: *&*
Disallow: /storage/
Disallow: /dashboard/
Disallow: /front/
Disallow: /vendor/
Host: {{ $url }}/

User-Agent: Googlebot
Disallow: */index.php
Disallow: *?*
Disallow: *&*
Disallow: /storage/
Disallow: /dashboard/
Disallow: /front/
Disallow: /vendor/

Sitemap: {{ $url }}/sitemap.xml
