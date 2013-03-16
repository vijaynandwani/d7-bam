core = 7.x
api = 2

projects[] = drupal

projects[colorbox][subdir] = contrib

projects[advanced_help] = 1.0-beta1
projects[advanced_help][subdir] = contrib
projects[advanced_help][patch][] = "http://drupal.org/files/issues/advanced_help-invalid_argument_in_modules_alter-1086990-14.patch"

libraries[colorbox][download][type] = file
libraries[colorbox][download][url] = http://colorpowered.com/colorbox/latest
