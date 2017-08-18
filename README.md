# MakerFor3n

This is a demo

Follow: https://gist.github.com/lqdung-lockon/3e2652eaa44fb28152f341fc02d1aedb

Run this command to generate table: `vendor/bin/doctrine orm:schema-tool:update --force`

Please fix function in `Application.php:693` for priority `app/proxy/entity`.
Example:
```
$path[] = realpath(__DIR__.'/../../app/proxy/entity');
$newDriver = new AnnotationDriver(
    new CachedReader(new AnnotationReader(), new ArrayCache()), $path
);
```

### Note:
- The attribute `form_theme` of EventTrait annotation isn't running, maybe syntax of the block theme has error.
- Cannot use ChoiceType because of missing `choice_list` attribute.
