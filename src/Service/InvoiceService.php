<?php

namespace App\Service;

use App\Entity\Invoice;
use DateTime;
use PhpOffice\PhpWord\TemplateProcessor;

class InvoiceService
{
    public function generateDoc(Invoice $data, string $currency)
    {
        $filePath = "docs/{$data->getInvoiceId()}.docx";
        $templateProcessor = new TemplateProcessor('docs/templates/Template.docx');

        $vat = floatval($data->getPrice()) * 0.2;
        $yr = new DateTime($data->getDateIssued());

        $templateProcessor->setValue('client', $data->getClientName());
        $templateProcessor->setValue('matter', $data->getMatter());
        $templateProcessor->setValue('invoiceNo', $data->getInvoiceId()."/{$yr->format('Y')}");
        $templateProcessor->setValue('date', $data->getDateIssued());
        $templateProcessor->setValue('description', $data->getDescription());
        $templateProcessor->setValue('price', $data->getPrice());
        $templateProcessor->setValue('vat', $vat);
        $templateProcessor->setValue('totalWithVat', floatval($data->getPrice()) + $vat);
        $templateProcessor->setValue('issuer', $data->getIssuer());
        $templateProcessor->setValue('currency', 'US dollars' == $currency ? 'USD' : 'EUR');

        $templateProcessor->saveAs($filePath);

        return $filePath;
    }
}
