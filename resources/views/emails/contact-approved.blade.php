<x-mail::message>
# Thank You for Contacting Us

Hi {{ $submission->name }},

Thank you for reaching out to **Canberra Accountants**. We have received and reviewed your enquiry.

@if($submission->service_interested)
**Service of interest:** {{ $submission->service_interested }}
@endif

A member of our team will be in touch with you shortly to discuss your requirements.

If you have any urgent questions in the meantime, please call us on **(02) 6190 6075** or reply to this email.

Thanks,<br>
**Canberra Accountants**<br>
info@canberraaccountants.com.au
</x-mail::message>
