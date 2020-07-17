# Rinvex Countries Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


## [v7.3.0] - 2020-07-17
- Fix updated ioc codes for Singapore & Lebanon (fix #146)
- Add test cases for timezones and locales (Thanks @ker0x #66 #11)
- Add methods getTimezones and getLocales (#66) (Fixes #11)
- Update dutch reduced VAT rate (#139)

## [v7.2.0] - 2020-07-17
- Filter, sort, and check currencies uniqueness and fix returned array keys (BREAKING CHANGE!)
- Fix currencies validation rule

## [v7.1.0] - 2020-07-16
- Add currency Laravel validation rule
- Fix wrong currencies method naming (BREAKING CHANGE!)

## [v7.0.1] - 2020-04-04
- Drop laravel/helpers usage as it's no longer used

## [v7.0.0] - 2020-03-15
- Upgrade to Laravel v7.1.x & PHP v7.4.x

## [v6.1.2] - 2019-03-13
- Tweak TravisCI config
- Add currencies listing (#130)	a89f5d9
- solve testing wrong files paths (#131)
- Arrange currencies to return default currency for each country - Sort shortlist and longlist by country code / key & Add currency to shortlist
- Tweak currency loader to support both longlist & shortlist
- Update StyleCI config
- Enforce consistency

## [v6.1.1] - 2019-09-24
- Add missing laravel/helpers composer package

## [v6.1.0] - 2019-06-02
- Update composer deps
- Drop PHP 7.1 travis test

## [v6.0.0] - 2019-03-03
- Rename environment variable QUEUE_DRIVER to QUEUE_CONNECTION
- Require PHP 7.2 & Laravel 5.8
- Apply PHPUnit 8 updates

## [v5.0.2] - 2018-12-23
- Fix dialing code for Caribbean Netherlands, Curaçao","official, Saint Helena (fix #79)
- Mexico City is no longer called Distrito Federal
- New currency code: VEF became VES

## [v5.0.1] - 2018-12-22
- Update composer dependencies
- Add PHP 7.3 support to travis
- Mexico City is no longer called Distrito Federal

## [v5.0.0] - 2018-10-01
- Enforce Consistency
- Rename package to rinvex/countries

## [v4.0.0] - 2018-09-22
- Simplify code by using PHP7 null coalescing operator
- Fix stupid gitattributes export-ignore issues
- Rename country variable to countryCode for naming consistency
- Remove file header docblock
- Push forward PHPUnit version
- Update composer config
- Fix deprecated PHPUnit TestCase namespace
- Disable travis email notifications
- Fix git export-ignore dotfiles
- Support the new StyleCI CSS/JS beta features
- Add PHPUnitPrettyResultPrinter
- Enforce consistency
- Require PHP 7.1.0 at least
- Tweak composer file
- Typehint method returns
- Fix wrong method return types
- Update minimum required PHP version
- Update composer packages
- Update travis php versions
- Add Laravel Auto Discovery support and validation rule
- Add missing Kosovo emoji
- Drop StyleCI multi-language support (paid feature now!)
- Prepare and tweak testing configuration
- Update PHPUnit options

## [v3.1.0] - 2017-03-07
- Format country code to small case before retrieval
- Change internal methods visibility to protected
- Update StyleCI fixers and other supplementary files
- Enforce strict type declaration
- Enforce consistency and rename Country Loader class
- Execute reflections once per test class
- Fix strict type declaration issues and tweak code
- Update Ukrainian phone prefixes and native name fix

## [v3.0.0] - 2016-12-12
- Drop PHP 5.6 support
- Drop leaking dependency
- Require PHP 7.0 as a minimum requirement
- Fix wrong CountryLoaderException namespace (close #43)
- Add test suites for Loader class & helper methods (close #42)
- Apply few tweaks and enhancements
- Fix wrong tests namespace
- Add missing test cases
- Arrange country files into specific data domains
- Update .styleci.yml and .gitignore config
- Refactor documentation for easy reading
- Enforce clean git export archive
- fixed ukrainian data
- Drop LTS support

## [v2.0.0] - 2016-11-27
- Rewrite from scratch, add massively extensive country data
  - Add emoji flags & their unicode attributes (close #6)
  - Add GeoJson data (close #20)
  - Add SVG flags (close #19)
  - Add separate country files (close #13)
  - Compress longlist for production usage
  - Add countries short list
  - Re-write form scratch for better & more intuitive API
  - Add country divisions (close #22)
  - Separate country translations into individual files (close #24)
  - Add unit testing suite
  - Add useful helpers
  - Drop illuminate dependencies
  - Refactor documentation

## v1.0.0 - 2016-08-20
- Tag first release.

[v7.3.0]: https://github.com/rinvex/countries/compare/v7.2.0...v7.3.0
[v7.2.0]: https://github.com/rinvex/countries/compare/v7.1.0...v7.2.0
[v7.1.0]: https://github.com/rinvex/countries/compare/v7.0.1...v7.1.0
[v7.0.1]: https://github.com/rinvex/countries/compare/v7.0.0...v7.0.1
[v7.0.0]: https://github.com/rinvex/countries/compare/v6.1.2...v7.0.0
[v6.1.2]: https://github.com/rinvex/countries/compare/v6.1.1...v6.1.2
[v6.1.1]: https://github.com/rinvex/countries/compare/v6.1.0...v6.1.1
[v6.1.0]: https://github.com/rinvex/countries/compare/v6.0.0...v6.1.0
[v6.0.0]: https://github.com/rinvex/countries/compare/v5.0.2...v6.0.0
[v5.0.2]: https://github.com/rinvex/countries/compare/v5.0.1...v5.0.2
[v5.0.1]: https://github.com/rinvex/countries/compare/v5.0.0...v5.0.1
[v5.0.0]: https://github.com/rinvex/countries/compare/v4.0.0...v5.0.0
[v4.0.0]: https://github.com/rinvex/countries/compare/v3.1.0...v4.0.0
[v3.1.0]: https://github.com/rinvex/countries/compare/v3.0.0...v3.1.0
[v3.0.0]: https://github.com/rinvex/countries/compare/v2.0.0...v3.0.0
[v2.0.0]: https://github.com/rinvex/countries/compare/v1.0.0...v2.0.0
