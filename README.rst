..  image:: https://img.shields.io/badge/PHP-8.1/8.2-blue.svg
    :alt: PHP 8.1/8.2
    :target: https://www.php.net/downloads

..  image:: https://img.shields.io/badge/TYPO3-12-orange.svg
    :alt: TYPO3 12
    :target: https://get.typo3.org/version/12

..  image:: https://img.shields.io/badge/License-GPLv3-blue.svg
    :alt: License: GPL v3
    :target: https://www.gnu.org/licenses/gpl-3.0

======
DA Bib
======

The extension provides a data model for bibliographic data. It is largely
modelled after the ``biblStruct`` `element in TEI XML
<https://www.tei-c.org/release/doc/tei-p5-doc/en/html/ref-biblStruct.html>`__
as `produced by Zotero
<https://github.com/zotero/translators/blob/master/TEI.js>`__. In addition,
entries may carry descriptions, summaries, (cover) images, and other files to
put together annotated bibliographies. The data can be listed as a full
bibliography, but entries and contributors may also be grouped via labels, and
other data models can reference and elaborate on individual entries using a
``Reference`` class. A flexible ``SameAs`` class adds options to identify, for
example, authors via their OrcIDs in linked-data scenarios. A frontend plugin
provides options to display selections of the bibliography, and a few common
serialisations of bibliographic data are included out of the box. A TYPO3 task
can be activated to periodically and automatically import data from a Zotero
library.

:Repository:  https://gitlab.rlp.net/adwmainz/digicademy/t3xdev/da-bib
:Read online: https://docs.typo3.org/p/da-bib/main/en-us/
:TER:         https://extensions.typo3.org/extension/da-bib/

Roadmap
=======

This is a pre-release version. The following steps are required for the software to move out of beta:

**Version 0.7.0**

- TCA and model work as expected
- Working frontend plugin

**Version 0.8.0**

- Import of DFD data
- Serialisation(s) of DFD data
- Consider adding a generic search config

**Version 0.9.0**

- Make Zotero import generic
- Make serialisation(s) generic

**Version 1.0.0**

- Add testing
- Finish documentation
