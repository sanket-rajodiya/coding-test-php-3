<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index','view']);
    }
    public function initialize(): void
    {
        parent::initialize();
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
        $this->viewBuilder()->setOption('serialize', ['articles']);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Users'],
        ]);
        $likesCount = $this->Articles->ArticleLikes->find()
            ->select(['likes_count' => 'COUNT(*)'])
            ->where(['article_id' => $article->id])
            ->first();
        $article->likes_count = $likesCount->likes_count ?? 0;

        $this->set(compact('article'));
        $this->viewBuilder()->setOption('serialize', 'article');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id = $this->Authentication->getIdentityData('id');
            if ($this->Articles->save($article)) {
                $data = [
                    'message' => 'Article Added...',
                    'article' => $article,
                ];
            }else{
                $data = [
                    'message' => 'Article not added Please try again',
                    'status' => 'failed',
                ];
            }
           
        }
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', 'data');
        return;
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        $userId = $this->Authentication->getIdentityData('id');
        if($article->user_id == $userId){
            
        
            if ($this->request->is(['patch', 'post', 'put'])) {
               
                $article = $this->Articles->patchEntity($article, $this->request->getData());
                
                if ($this->Articles->save($article)) {
                    $data = [
                        'message' => 'Article updated!',
                        'status' => 'success',
                    ];
                    
                }else{
                    $data = [
                        'message' => 'Error updating Article!',
                        'status' => 'Failed',
                    ];
                }
            }
            
        }else{
            $data = [
                'message' => 'Unauthorized User!',
                'status' => 'Failed',
            ];
        }
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', 'data');
        return;
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        $userId = $this->Authentication->getIdentityData('id');
        if($article->user_id == $userId){
            if ($this->Articles->delete($article)) {
                $data = [
                    'message' => 'Article deleted!',
                    'status' => 'success',
                ];
            } else {
                $data = [
                    'message' => 'The article could not be deleted. Please, try again',
                    'status' => 'Failed',
                ];
               
            }

            
        }else{
            $data = [
                'message' => 'Unauthorized User!',
                'status' => 'Failed',
            ];
        }
        $this->set(compact('data'));
        $this->viewBuilder()->setOption('serialize', 'data');
        return;

    }
    
}
