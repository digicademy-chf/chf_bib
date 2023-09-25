..  include:: /Includes.rst.txt

..  _install-and-config:

==================
Install and config
==================

..  rst-class:: bignums

1.  Install the extension

    Add the package name to your ``composer.json`` or install the package
    manually.

2.  Set up a data folder

    In a blank folder in your page tree, add a ``BibliographicResource``.
    Further data, such as entries, needs to be located in the same data folder.
    ``Reference``s, however, are an exception as they only point towards
    entries and may be part of other data models.

3.  Optionally add a Zotero task

    You need to add a Zotero URI to your bibliography and set up an import task
    if your data is supposed to be imported from Zotero periodically. This may
    only be allowed for admins in your TYPO3 system.
    
    Go to your data folder, open the bibliography you want to import via
    Zotero, and add the Zotero sync URI. Then go to the :guilabel:`Task` module
    in the backend, add a new task, and select :guilabel:`Import bibliography
    from Zotero`. Enter the values required to perform the task and either
    start the task manually or set an interval to run the task automatically.

..  _display-the-bibliography:

========================
Display the bibliography
========================

To show the bibliography on a specific page of your website, simply add the
:guilabel:`Bibliography` plugin and set it up to use the bibliography in
question.

If you want to be able to only show select entries from your bibliography, use
the label function built into the extension. You can add a ``Tag`` of type
:guilabel:`Label` to your data folder and then select it in the entries or
contributors you want it to apply to. You can then select the label in the
plugin to display only those entries or contributors.
