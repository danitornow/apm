# apm
Files for the APM Stack, Telegraf, InfluxDB, Grafana

## Config for Telegraf and InfluxDB
These are just the final versions of the ones I used to
create the Full Demo version.

Be sure to make your own edits or generate a custom
Telegraf config.

## PHP Read Files
PHP-file-demo is a set of files to just throw in data about
how long a file takes to be "processed". This processing is
faked by randomizing a sleep and reading a number from the
data folders. There is not sanitizing of inputs, this is just
a mechanism to throw exec times into a UDP localhost endpoint.

Runs on PHP 7.1.

Run in background (and run multiples) with:
`nohup php read_files1.php &`

## See the slides at:
[Google Slides](https://docs.google.com/presentation/d/1ce_sEqjtOWH22DmGUx8yhnbPm-1KgoiZJehPmXpBRjQ/edit?usp=sharing)

## Other Helpful Links
[InfluxDB Documentation v1.2](https://docs.influxdata.com/influxdb/v1.2/)
[Telegraf Documentation v1.2](https://docs.influxdata.com/telegraf/v1.2/)
[Grafana Documentation](http://docs.grafana.org/)
