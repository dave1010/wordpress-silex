wordpress-silex
===============

A lightweight, incredibly fast Silex-based front-end that talks to a WordPress instance via a JSON API, running in React's event-based model.

Features / Aims

* Create sites and apps using modern tools like Silex, Twig and Symfony components
* Simple caching with Memcached
* Use WordPress for the CMS / admin and DB (wp-admin)
* Keep WordPress locked down with a firewall and serve a simple app to users
* Instantiate WordPress once as a server (using React), and serve many requests asyncronously (means the WordPress core and plugins are only loaded once, instead of for each HTTP request)
* Provide a clean API barrier between (non-PSR, PHP 5.2) WordPress code and more modern PSR-friendly components

