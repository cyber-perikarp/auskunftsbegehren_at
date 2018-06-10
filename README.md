# auskunftsbegehren.at


[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cyber-perikarp/auskunftsbegehren_at/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cyber-perikarp/auskunftsbegehren_at/?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/6225f49da0e0ccaa7fde/maintainability)](https://codeclimate.com/github/cyber-perikarp/auskunftsbegehren_at/maintainability)
[![Build Status](https://travis-ci.org/cyber-perikarp/auskunftsbegehren_at.svg?branch=master)](https://travis-ci.org/cyber-perikarp/auskunftsbegehren_at)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/7f0a7585d0dd416ca7f2137c99812b4e)](https://www.codacy.com/app/deadda7a/auskunftsbegehren_at?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=cyber-perikarp/auskunftsbegehren_at&amp;utm_campaign=Badge_Grade)
[![Dependency Status](https://www.versioneye.com/user/projects/5a325db20fb24f703eb74376/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5a325db20fb24f703eb74376)
[![Coverage Status](https://coveralls.io/repos/github/cyber-perikarp/auskunftsbegehren_at/badge.svg?branch=master)](https://coveralls.io/github/cyber-perikarp/auskunftsbegehren_at?branch=master)

Quellcode für https://www.auskunftsbegehren.at

Zugehörige Projekte:
* [Webseite](https://github.com/cyber-perikarp/auskunftsbegehren_at) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
* [Serverkonfiguration](https://github.com/cyber-perikarp/auskunftsbegehren_at_serverconfig) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
* [Adressdaten](https://github.com/cyber-perikarp/auskunftsbegehren_at_adressen) [![License: CC BY-SA 4.0](https://img.shields.io/badge/License-CC%20BY--SA%204.0-lightgrey.svg)](https://creativecommons.org/licenses/by-sa/4.0/)

## Initales Aufsetzen
1. Repo clonen
2. Webserver einrichten
3. .env-sample nach .env kopieren und anpassen
4. php yii migrate ausführen im Projektordner
5. auskunftsbegehren_at_adressen importieren
6. /var/pdfStorage erstellen und dem Webserver Schreibrechte geben
7. Mailcatcher oder so oder MTA einrichten
8. <hier noch welche LaTeX Pakete man braucht schreiben>
