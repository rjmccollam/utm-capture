# UTM Capture

Current version - 1.1.0

## Overview

Create a system to capture PPC campaign parameters from the URL from the first page a user visits, then pass that data to the Gravity Form entry on a subsequent page.

## Scope

### Managing UTM Cookies

Captured parameters will be stored as cookies that expire after 30 days.

On page load where parameters exist check first to see if cookie for `utm_source` exists

- If it **does** exist do not set cookies
- If it **does not** exist set cookies

**Parameters to capture:**

- `utm_source`
- `utm_medium`
- `utm_term`
- `utm_content`
- `utm_campaign`

### Additional Fields Supports

While cookies may not be set for these fields they are available for field population so they can be captured.

- `referer` - Grabs the referring domain if it is available.

### Populating Gravity Form Fields

If a form contains fields with the properly named parameters and the user has the cookies — populate the form fields with cookie values.

**Configuring Fields**

- Each field you want to be populated should be a hidden field.
- In the **Advanced** tab for the field and have the **Allow field to be populated dynamically** checked.
- The **Parameter Name** matches up to the **Parameters to capture** listed above.