# GraphQL Webform Drupal module
A module to integrate webform with the graphql module.

IMPORTANT: This is a module under active development and it does not support all webform features and elements yet. Feel free to raise Feature Requests and to contribute :)

## Pre-Requisites

 1. [graphql module](https://www.drupal.org/project/graphql)

## Supported elements

 - Text Field
 - Email
 - Textarea
 - Hidden
 - Date
 - Checkboxes
 - Radios
 - Select
 - File
 - Actions
 - Markup

## Retrieve webform elements

    {
      webformById(webform_id: "contact") {
        title
        description
        elements {
          ... on WebformElement {
            id
            type
          }
          ... on WebformElementActions {
            submitLabel
            title
          }
          ... on WebformElementTextBase {
            title
            defaultValue
            required {
              message
            }
            size
            minLength
            maxLength
            pattern {
              message
              rule
            }
            placeholder
          }
          ... on WebformElementMarkup {
            markup
          }
          ... on WebformElementTextarea {
            rows
          }
          ... on WebformElementHidden {
            defaultValue
          }
          ... on WebformElementDate {
            dateMin
            dateMax
            step
            defaultValue
            title
          }
          ... on WebformElementOptionsBase {
            title
            defaultValue
            options {
              title
              value
            }
            required {
              message
            }
          }
          ... on WebformElementSelect {
            emptyOption {
              title
              value
            }
          }
          ... on WebformElementManagedFile {
            title
            fileExtensions
            required {
              message
            }
          }
        }
      }
    }

## Create a webform submission

    mutation submit($values: String!) {
      submitForm(values: $values) {
        errors
        submission {
          id
        }
      }
    }

`$values` needs to be a JSON string. The following JSON object:

    {
      "webform_id":"contact",
      "subject":"This is the subject",
      "message":"Hey, I have a question",
      "date_of_birth":"05/01/1930",
      "email":"email@example.com"
    }
becomes the following string when creating a submit using the `submitForm` mutation

    {
      "values": "{\"webform_id\":\"contact\",\"subject\":\"This is the subject\",\"message\":\"Hey, I have a question\",\"date_of_birth\":\"05\/01\/1991\",\"email\":\"email@example.com\"}"
    }

`errors` contains the validation errors in case the values submitted are wrong. For example:

    {
      "data": {
        "submitForm": {
          "errors": [
            "Subject field is required.",
            "Message field is required.",
            "Fill in Date of Birth field."
          ],
          "submission": null
        }
      }
    }

### Create a webform submission when webform contains File elements
If the webform contains a File field, you need to submit/create the file before creating the submission itself. There is a `webformFileUpload` mutation available.

    mutation createFile($file: Upload!){
      webformFileUpload(file: $file, webform_id:"contact", webform_element_id: "upload_your_file") {
        errors
        violations
        entity {
          entityId
        }
        ... on WebformFileUploadOutput {
      	  fid
      	}
      }
    }


As the result you can check for errors, violations, entity and entityId. You can query for `entity > entityId` or `fid` to get the file id that was just created. `fid` is a necessary GraphQL field for cases where the graphql is performed by anonymous users and the file has been uploaded to the private folder.

When you get the fid (e.g. 10910) you then update the `$values` variable with it:

    {
      "values": "{\"webform_id\":\"contact\",\"subject\":\"This is the subject\",\"message\":\"Hey, I have a question\",\"date_of_birth\":\"05\/01\/1991\",\"email\":\"email@example.com\",\"upload_your_file\":\"10910\"}"
    }
