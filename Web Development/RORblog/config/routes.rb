# Author: Francis Hackenberger
# Date: 2016-10-18
# Description: Routes file 

Rails.application.routes.draw do
  resources :articles do
  	resources :cotsmmen
  end
 
  root 'welcome#index'
end