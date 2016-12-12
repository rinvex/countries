# Rinvex Country Change Log

All notable changes to this project will be documented in this file.

This project adheres to [Semantic Versioning](CONTRIBUTING.md).


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
- Commit first draft.

[v3.0.0]: https://github.com/rinvex/country/compare/v2.0.0...v3.0.0
[v2.0.0]: https://github.com/rinvex/country/compare/v1.0.0...v2.0.0
