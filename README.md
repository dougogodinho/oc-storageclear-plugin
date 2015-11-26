# Genius Storage Cleaner

- [Description](#description)
- [Usage](#usage)
- [To do](#todo)

<a name="description"></a>
## Description

Scan the Uploads folder searching disconnected files with the database.

> Heads up! This script will delete files from your disk and data in your database.

<a name="usage"></a>
## Usage

After install run:

    php artisan storage:clear

- The above command will look in your storage directory: storage/app/uploads for files that are not linked to the \System\Models\File entity (which we love so much).
- Files that have no link will be removed, including the thumbnails generated at runtime (do not worry, they [thumbnails] will be regenerated according to the need).
- Then will be located the records of File entity that does not have disk files, they will also be deleted.
- Finally... remove empty folders!

Is it! Be happy!


<a name="todo"></a>
## To do

- Ask for user confirmation before deletes
- List files who will be deleted
- User can select what will be deleted
- Interface to storage clear from backend



