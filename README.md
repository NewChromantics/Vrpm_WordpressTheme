# Installing theme

- Commit changes (the strict dev in me, says make a branch :)
- Change version in `style.css`. For safety, update the NAME as well as the version from `VRPM 1.x.x`, and it will install a new theme along side the old one which can be used as a preview to make sure nothing is broken
- Commit this version change.
- Run this command to create a clean zip (no git files) `git archive --format zip --output ~/Desktop/Vrpm_WordpressTheme.zip HEAD -0`
- Install this theme in wordpress, and should see a new theme called `VRPM `1.x.y`
