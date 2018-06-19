# Sources / Credits

  - Bootstrap via BootstrapCDN
  - FontAwesome via BootstrapCDN
  - jQuery 2.2.3 via jQueryCDN
  - Exchange rates via cryptonator.com API
  - @hamlesh for providing original source

# Release History (Legacy from original fork)
## v2.0.3 - 06/2017
- Now working with new Ethermine Api
- Added workers
- forked from tsumaru720/ethermine-stats

## v2.0.2 - 06/2017
Removed php short tags, and a few other minor UI tweaks.  Added the ability 
to calculate and include the cost of power when displaying mining profitability.
Thanks to @tsumaru720 for the idea :)


## v2.0.1 - 06/2017
A few bits broke following the recent changes to the Ethermine API.  This patch 
fixes those issues.  Also switched to distributing config.php.dist, so as not 
to accidentally overwrite your config file.  There will be a few new views i'll 
add soon, thanks to the improvements in the Ethermine API.


## v2 - 06/2017
Some major changes in the way the codebase works, with much faster load times.
Replaced coindesk and fixer apis with cryptonator.  Local file cache to handle 
busy/empty response from Ethermine API.

  - Fixed the various bugs from v1
  - Added base FIAT currency settings
  - Removed coindesk.com and fixer.io APIs
  - Added cryptonator.com API
  - Added local file cache of Ethermine API data
  - Changed reload time to 5 mins as default

## v1 - 10/2016
Version never properly released, and I wasn't following any versioning control.
I have the original code base somewhere, I'll post it for the sake of posterity.
The v1 code base won't actually work anymore, due to changes in the Ethermine 
API.
