SharesCounter
=============

Retrieves the number of shares from a certain social network

How to use
==========

```php
$counter = new MASNathan\Social\SharesCounter('https://github.com');

echo 'Twitter: ' . $counter->getTwitter() . '<br />';
echo 'Facebook: ' . $counter->getFacebook() . '<br />';
echo 'Google Plus: ' . $counter->getGooglePlus() . '<br />';
echo 'LinkedIn: ' . $counter->getLinkedIn() . '<br />';
echo 'Pinterest: ' . $counter->getPinterest() . '<br />';
echo 'StumbleUpon: ' . $counter->getStumbleUpon() . '<br />';
```