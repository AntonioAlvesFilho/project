import { extend } from 'vee-validate'
import { required, email } from 'vee-validade'
import { messages as messagePt } from 'vee-validade'

extend('required', {
  ...required,
  message: messagePt.required
})

extend('email', {
  ...email,
  message: messagePt.email
})
