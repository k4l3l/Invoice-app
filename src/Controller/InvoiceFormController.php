<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\Type\InvoiceType;
use App\Service\InvoiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceFormController extends AbstractController
{
    /**
     * @Route("/", name="invoice_form")
     */
    public function index(InvoiceService $service, Request $request)
    {
        $invoice = new Invoice();
        $invoiceForm = $this->createForm(InvoiceType::class, $invoice);
        $invoiceForm->handleRequest($request);
        $currency = $invoiceForm['currency']->getData();

        if ($invoiceForm->isSubmitted() && $invoiceForm->isValid()) {
            $invoice->setFileLocation($service->generateDoc($invoiceForm->getData(), $currency));
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->render('invoice_form/index.html.twig', [
                'invoiceForm' => $invoiceForm->createView(),
            ]);
        }

        return $this->render('invoice_form/index.html.twig', [
            'invoiceForm' => $invoiceForm->createView(),
        ]);
    }
}
