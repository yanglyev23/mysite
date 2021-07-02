<?
namespace App\Controller;

use App\Helper\RetailCRMHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\DBAL\Driver\Connection;
use App\Entity\Leads;

class CreateOrderController extends Controller{
    public function __construct(RetailCRMHelper $retailCrmHelper)
    {
        $this->retailCrmHelper = $retailCrmHelper;
    }
    /**
     * @Route(
     *      "/create/order"
     * )
     */
    public function createOrder():Response{
        //$result = $this->retailCrmHelper->createOrder("name");
        return new Response($result);
    }
    /**
     * @Route(
     *      "/retailcrm/orders"
     * )
     */
    public function show():Response{
        $result = $this->retailCrmHelper->showOrders();
        return $this->render("orders/order.html.twig", array(
            'result' => $result
        ));
    }

    /**
     * @Route("/get/amo")
     */
    public function getAmo(Request $request): Response
    {

        $leads = $request->request->get('leads'); 
        $id = intval($leads['update'][0]['id']);
        $name = strval($leads['update'][0]['name']);
        $price = intval($leads['update'][0]['price']);
        $status = intval($leads['update'][0]['status_id']);
        /*if ($status = 40994974){
            $result = $this->retailCrmHelper->createOrder($name);
        }*/
        $rid = 0;
        $entityManager = $this->getDoctrine()->getRepository(Leads::class);
        $lead = $entityManager->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        if(!$lead){
            $lead = new Leads();
            $lead -> setId($id);
            $lead -> setName($name);
            $lead -> setPrice($price);
            $lead -> setRetaicrmID($rid);
            $entityManager -> persist($lead);
            $entityManager -> flush();
        }
        else{
            $lead->setName($name);
            $lead->setPrice($price);
            $lead -> setRetaicrmID($rid);
            $entityManager -> flush();
        }
        return new Response($id);
    }
}