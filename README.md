EdpUserTwitter
==============
Version 0.0.1 Created by Evan Coury

Introduction
------------

This is a quick and dirty proof-of-concept on how one could extend my 
[EdpUser](https://github.com/EvanDotPro/EdpUser) ZF2 module.

Requirements
------------

* Zend Framework 2
* [EdpUser](https://github.com/EvanDotPro/EdpUser) (latest master).

Installation
------------

- Clone into your `modules/` directory.
- Enable in `application.config.php`.
- Manually add a `twitter` field to your `user` table. Make it VARCHAR(255),
  default NULL.
