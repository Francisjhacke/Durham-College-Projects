   M S B A M L   `   `   `  ����F  BKingWilliam, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null)clr-namespace:KingWilliamKingWilliam  5   	       KingWilliam.ChangeRoom   5   	   W SPresentationCore, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35R NWindowsBase, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35\ XPresentationFramework, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35D 9http://schemas.microsoft.com/winfx/2006/xaml/presentation    5   	   R NSystem.Xaml, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   @d2http://schemas.microsoft.com/expression/blend/2008     5   	   Jmc;http://schemas.openxmlformats.org/markup-compatibility/2006     5   	   +localclr-namespace:KingWilliam     5   	     � Title$  
ChangeRoom��5   	   $��329.512��6   $��648.644��6-    � WindowStyle$
 None=�6=   .��5	      � .+�5
   
   �� -   5         ��Name$ lblRoomType��5
      $��
Room Type:��6%   $��Center=�6:   $
��Left=�6^   $	��Top=�6y   $��16(�6�   $��91��6�   $��211,120,0,0q�6�   �� 5   
   -   5         ��Name$ cmbRoomType��5      $
��Left=�6(   $	��Top=�6C   $	��120��6[   $��16(�6g   $��355,124,0,0q�6u   6�   �� 5   
   -   5        $ lblRoomType_Copy��5      $��Room Number:��6*   $��Center=�6A   $
��Left=�6e   $	��Top=�6�   $��16(�6�   $	��127��6�   $��195,174,0,0q�6�   �� 5   
   -   5        $ cmbRoomNumber��5      $
��Left=�6*   $	��Top=�6E   $	��120��6]   $��16(�6i   $��355,180,0,0q�6w   �� 5   
   -   5         ��Name$ 	btnSubmit��5      $��Submit��6$   $
��Left=�65   $	��Top=�6P   $	��195��6h   $��32��6t   ���	#FF9A6836$��18(�6�   ���	#FFF1F1F1$��101,247,0,0q�6�   6�   �� 5   
   -   5        $ 	btnCancel��5      $��Cancel��6$   $
��Left=�65   $	��Top=�6P   $	��195��6h   $��32��6t   ���	#FF9A6836$��18(�6�   ���	#FFF1F1F1$��355,247,0,0q�6�   6�   �� 5   
   -   5        $ lblStartDate��5      $��Reservation Start Date:��6&   $��Center=�6H   $
��Left=�6l   $	��Top=�6�   $��16(�6�   $	��178��6�   $��
134,21,0,0q�6�   �� 5   
   -   5        $ 
lblEndDate��5      $��Reservation End Date:��6$   $��Center=�6D   $
��Left=�6h   $	��Top=�6�   $��16(�6�   $	��192��6�   $��
157,69,0,0q�6�   (  "System.Windows.Controls.DatePicker  5   
   -	   5          Name$ dpiStartDate��5      $
��Left=�6+   $	��Top=�6F   $��16(�6^   $	��132��6m   |�.  $��
355,21,0,0q�6�   6�     5   
   -
   5        $ 
dpiEndDate��5      $
��Left=�6)   $	��Top=�6D   $	��132��6\   $��16(�6h   $��32��6w   |�.  $��
355,69,0,0q�6�   6�   5      5      