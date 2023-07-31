..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

All records of a single bibliography are held together by the main classes
(``Entry``, ``Contributor``, and ``Tag``) being children of a single
``BibliographicResource``. The core class ``Entry`` has a set of fields that
contain inforomation of non-independent items (e.g. papers in a journal) as
well as independent publications (e.g. the journal itself). Entries may be
connected to other data models, which may specify elaborations such as the
specific page number of a citation, by using the class ``Reference``.

``Scope``s may be used several times in a bibliographic entry to provide, for
example, volume and number of the journal an article is published in. The same
class is used to enable providing multiple identifiers. ``Contributors`` were
also pulled into their own class because they may occur multiple times per
publication, but they have their role (e.g., author or editor) specified by
being added to the right property of an ``Entry``.

In addition, the model knows flexible ``Tag``s and ``SameAs`` classes, which
can be used to group entries and contributors via labels and to connect
entities to Linked Open Data.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /DataModel/DataModel.png
    :alt: Data model of the extension
    :target: /DataModel/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference` for further details.
