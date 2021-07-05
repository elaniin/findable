<p align="center">
<img src="https://user-images.githubusercontent.com/12446271/113485232-c014d600-9469-11eb-8dfa-637dc21c0e46.png" alt="Findable Logo" width="251.5">
</p>
<p align="center">
<a href="https://github.com/elaniin/findable/actions/workflows/build.yml"><img src="https://github.com/elaniin/findable/actions/workflows/build.yml/badge.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/elaniin/findable"><img src="https://img.shields.io/packagist/dt/elaniin/findable" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/elaniin/findable"><img src="https://img.shields.io/packagist/v/elaniin/findable" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/elaniin/findable"><img src="https://img.shields.io/packagist/l/elaniin/findable" alt="License"></a>
</p>

<p align="center">
Improve SEO in your Statamic-powered site!
</p>

## ✨ Features

- **Meta Tags:** The standard meta tags for title, description, and robots
- **OpenGraph:** Improve how your website looks when is shared in social networks like Facebook, Twitter, and Slack
- **Structured Data:** Let the search engines know the semantic meaning of the content of your website
- **Sitemap:** Automatically create an XML sitemap that includes all your URLs (index by collection)
- **Webmaster Tools:** With Findable, verifying your website never was so easy!
- **Marketing:** Forget about code-spagetting when implementing marketing tools! Use Google Tag Manager with a single setting
- **HREF Lang:** If your Statamic installation is multisite for multiple languages, Findable will find them and add accordingly the available translations for every entry

## 💿 Installation

Via composer:

```shell
composer require elaniin/findable
```

Publish config (optional):

```shell
php artisan vendor:publish --provider="Elaniin\Findable\ServiceProvider" --tag=config
```

Publish views (optional):

```shell
php artisan vendor:publish --provider="Elaniin\Findable\ServiceProvider" --tag=views
```

Publish translations (optional):

```shell
php artisan vendor:publish --provider="Elaniin\Findable\ServiceProvider" --tag=translations
```

Add Findable's tags to your layout:

- `{{ findable:head }}`: Should be within the `<head>` tag
- `{{ findable:body }}`: Should be right after the `<body>` opening tag
- `{{ findable:footer }}`: Should be right before the `</body>` tag

Example `layout.antlers.html`:

```html
<head>
	...
	{{ findable:head }}
</head>

<body>
	{{ findable:body }}
	...
	{{ findable:footer }}
</body>
```

## 🔒 License

Findable is open-sourced software licensed under the [MIT license](LICENSE).
