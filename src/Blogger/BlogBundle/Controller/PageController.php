<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;

/**
 * Description of PageController
 *
 * @author seyfer
 */
class PageController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()
                ->getManager();

        $blogs = $em->getRepository("BloggerBlogBundle:Blog")
                ->getLatestBlogs(5);

        return $this->render('BloggerBlogBundle:Page:index.html.twig', array(
                    'blogs' => $blogs
        ));
    }

    public function sidebarAction()
    {
        $em = $this->getDoctrine()
                ->getManager();

        $tags = $em->getRepository('BloggerBlogBundle:Blog')
                ->getTags();

        $tagWeights = $em->getRepository('BloggerBlogBundle:Blog')
                ->getTagWeights($tags);

        $commentLimit   = $this->container
                ->getParameter('blogger_blog.comments.latest_comment_limit');
        $latestComments = $em->getRepository('BloggerBlogBundle:Comment')
                ->getLatestComments($commentLimit);

        return $this->render('BloggerBlogBundle:Page:sidebar.html.twig', array(
                    'latestComments' => $latestComments,
                    'tags'           => $tagWeights
        ));
    }

    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form    = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {

                \Blogger\DebugBundle\Tools\Debug::dump($request->request->all());

                $message = \Swift_Message::newInstance()
                        ->setSubject('Contact enquiry from symblog')
                        ->setFrom('enquiries@symblog.me')
                        ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
                        ->setBody(
                        $this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array(
                            'enquiry' => $enquiry
                                )
                ));

                $numSent = $this->get('mailer')->send($message);
                $this->get('session')
                        ->getFlashBag()
                        ->add('blogger-notice', "Your {$numSent} contact enquiry was successfully sent. Thank you!");

                // Perform some action, such as sending an email
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
            }
        }

        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
