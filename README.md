# Looking for Perch 3?

This app has been redeveloped to take advantage of the new APIs and user interface of Perch 3. Please find the new repository here: [https://github.com/RedFinch/Perch-Event-Log](https://github.com/RedFinch/Perch-Event-Log).

This app will no longer be receieving updates.

# Perch Activity Log
An event based activity log for the Perch CMS. Useful for keeping track which content editors have published changes and viewing the historical differences.

Currently the events logged are:

* region.add_item
* region.publish
* item.delete
* category.create
* category.update
* assets.create_image

More information about Perch events can be found on the [API docs](https://docs.grabaperch.com/api/events/).

### Installation
Move the `jw_activity_log` folder to your `perch/addons/apps directory`. You do not need to add anything to the `runtime.php` file.

You can optionally configure which roles have access to the activity log through the role permissions menu.

### Settings
You may configure how long logs are kept for in the Perch settings menu. Logs can be set to auto delete after:

* 1 Week
* 2 Weeks
* 1 Month
* 3 Months (Default)
* 6 Months
* 1 Year

### Attributions
Icons used from the [FamFamFam Silk Pack](http://www.famfamfam.com/lab/icons/silk/) licensed under a [Creative Commons Attribution 2.5 License](http://creativecommons.org/licenses/by/2.5/).

### License
The MIT License (MIT)

Copyright (c) 2015 James Wigger

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
