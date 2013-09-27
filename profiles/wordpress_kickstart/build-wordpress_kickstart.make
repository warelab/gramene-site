api = 2
core = 7.x
; Include the definition for how to build Drupal core directly, including patches:
includes[] = drupal-org-core.make
projects[wordpress_kickstart][download][type] = "git"
projects[wordpress_kickstart][download][profile] = "contributions/profiles/wordpress_kickstart"
projects[wordpress_kickstart][download][revision] = "7.x-1.x"