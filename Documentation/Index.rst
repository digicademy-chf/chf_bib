..  include:: /Includes.rst.txt

.. _start:

=======
CHF Bib
=======

:Extension key:
    chf_bib

:Package name:
    digicademy/chf_bib

:Version:
    |release|

:Language:
    en

:Author:
    `Jonatan Jalle Steller <mailto:jonatan.steller@adwmainz.de>`__,
    CHF Bib contributors

:License:
    This document is published under the
    `CC BY 4.0 <https://creativecommons.org/licenses/by/4.0/>`__
    license.

:Rendered:
    |today|

----

The extension provides a data model for bibliographic data, as part of the
Cultural Heritage Framework (CHF). It is largely modelled after the ``biblStruct``
`element in TEI XML <https://www.tei-c.org/release/doc/tei-p5-doc/en/html/ref-biblStruct.html>`__
as `produced by Zotero <https://github.com/zotero/translators/blob/master/TEI.js>`__.
In addition, entries may carry descriptions, summaries, (cover) images, and other
files to put together annotated bibliographies. The data can be listed as a full
bibliography, but entries and contributors may also be grouped via labels, and
other data models can reference and elaborate on individual entries using a
``Reference`` class. A ``SameAs`` class may be used to identify, for example,
authors via their ORCIDs in linked-data scenarios. A frontend plugin provides
options to display selections of the bibliography, and a few common
serialisations of bibliographic data are included out of the box. A TYPO3 task
can be activated to periodically and automatically import data from a Zotero
library.

----

**Table of contents:**

..  toctree::
    :maxdepth: 2
    :titlesonly:

    Introduction/Index
    InstallAndConfig/Index
    EditingContent/Index
    Templates/Index
    DataModel/Index
    ApiReference/Index
    Maintenance/Index

..  Meta Menu

..  toctree::
    :hidden:

    Sitemap
