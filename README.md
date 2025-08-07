Creates a Satis file to generate a private Composer repository.

# Init

composer install

make start

# Execute

make enter

php src/generate.php var/sample/input var/sample/output

Input file sample:

```yml
# Path where the libraries are located
path_pre: /projects/%s/php-libs/%s
#path_pre: https://github.com/%s/%s

# Optional: Path where each library contains its code
path_post: code

packages:
  - yosmanyga/lib-1
  - yosmanyga/lib-2
```

Output file:

```json
{
  "name": "satis",
  "description": "PHP Packages",
  "homepage": "http://localhost:8080",
  "repositories": [
    {
        "name": "yosmanyga/lib-1",
        "type": "vcs",
        "url": "/projects/yosmanyga/php-libs/lib-1/"
    },
    {
        "name": "yosmanyga/lib-2",
        "type": "vcs",
        "url": "/projects/yosmanyga/php-libs/lib-2/"
    }
  ],
  "require-all": true
}
```

You can modify the `path_pre` and `path_post` to fit your needs. The `%s` will be replaced by the package name parts.

You can also modify the satis template, located in `src/satis.json.mustache`.