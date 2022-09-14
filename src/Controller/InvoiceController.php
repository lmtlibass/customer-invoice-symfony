<?php
namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Entity\InvoiceLine;
use App\Form\InvoiceLineType;
use App\Repository\InvoiceRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvoiceController extends AbstractController
{
    public function __construct(InvoiceRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em         = $em;
    }

    public function index(){
        return $this->render('base.html.twig');
    }

    
    /**
     * @Route("invoice/create", name="invoice.create")
     */
    public function new(Request $request){
        $invoice = new Invoice();
        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($invoice);
            $this->em->flush();
            return $this->redirectToRoute("lineInvoice.create");
        }


        return $this->render('invoice/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("lineInvoice/create", name="lineInvoice.create")
     */
    public function create(Request $request, ){
        $invoiceLine = new InvoiceLine();
        $form = $this->createForm(InvoiceLineType::class, $invoiceLine);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($invoiceLine);
            $this->em->flush();
            $this->addFlash('success', 'invoice created successfully');
            return $this->redirectToRoute("lineInvoice.create");

        }

        return $this->render('invoiceLine/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

}