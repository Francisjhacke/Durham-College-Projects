   M S B A M L   `   `   `  ����N  JMountainViewProject, Version=1.0.0.0, Culture=neutral, PublicKeyToken=null9!clr-namespace:MountainViewProjectMountainViewProject  5   	   $    MountainViewProject.MainWindow   5   	   \ XPresentationFramework, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35R NWindowsBase, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35W SPresentationCore, Version=4.0.0.0, Culture=neutral, PublicKeyToken=31bf3856ad364e35D 9http://schemas.microsoft.com/winfx/2006/xaml/presentation    5   	   R NSystem.Xaml, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089:x,http://schemas.microsoft.com/winfx/2006/xaml     5   	   @d2http://schemas.microsoft.com/expression/blend/2008     5   	   Jmc;http://schemas.openxmlformats.org/markup-compatibility/2006     5   	   3local!clr-namespace:MountainViewProject     5   	     � Title$
  Main��5   	    � 
ResizeMode$ CanMinimize=�6    � WindowStartupLocation$ CenterScreen=�6/    � WindowState$ 	Maximized=�6T   $��867.2��6l   $��1540.8��6{   .��5
      �  � ColumnDefinitions 5   
   �� 5      $	��17* �6   �� 5      $��7* �6   �� 5      $	��94* �6   .+�5   
   �� $��0 0 0 1q�6   ���	#FF3556C8$
��Left=�6D   $	��119��6_   $	��Top=�6l   $
��1534��6�   $��3��6�   ._�5      ��  �� Orientation$ 
Horizontal=�6   $��Center=�62   .+�5      �� -   5         ��Name$ image��5      $
��Left=�6'   $��96��6B   $��	57,10,0,0q�6N   $	��Top=�6a   $��86��6y   $��Images/logo.png��6�    J� RenderTransformOrigin$ 0.437,0.013&�6�   �� 5      -   5         ��Name$ title��5      $��Mountain View Hospital��6'   $��Center=�6H   $��	20,10,0,0q�6e   $	��Top=�6x   $��96��6�   $	��811��6�   $��58(�6�   ���	#FFA5A181$��Algerian)�6�   5      5      �� 5   
   -   5        	 ��Name$	 button_Copy��5      $
��Left=�6&   $��206,212,0,0q�6A   $	��Top=�6V   $	��296��6n   $	��103��6z   ���	#FF4A67E0$��3��6�   .��5      �� $	��236��6   $ 
Horizontal=�6%   $��64��6>   .+�5      �� $��Images/patient.png��6   $��52��64   $��
40,2,0,0.2q�6?   �� 5      $��Patients��6   $��Center=�6+   $��Center=�6H   
�������$��20(�6w   $��20,2,0,0q�6�   $��43��6�   5      5      �� 5   
   -   5        $	 button_Copy1��5      $
��Left=�6'   $��206,361,0,0q�6B   $	��Top=�6W   $	��296��6o   $	��103��6{   ���	#FF4A67E0$��3��6�   .��5      �� $	��236��6   $ 
Horizontal=�6%   $��64��6>   .+�5      �� $��images/surgeon.png��6   $��52��64   $��
30,2,0,0.2q�6?   �� 5       $��
Physicians��6   $��Center=�6-   $��Center=�6J   
�������$��20(�6y   $��20,2,0,0q�6�   $��43��6�   5!      5"      �� 5#   
   -   5        $	 button_Copy2��5#      $
��Left=�6'   $��206,522,0,0q�6B   $	��Top=�6W   $	��296��6o   $	��103��6{   ���	#FF4A67E0$��3��6�   .��5$      �� $	��236��6   $ 
Horizontal=�6%   $��64��6>   .+�5%      �� $��images/bed.png��6   $��52��60   $��
40,2,0,0.2q�6;   �� 5&      $��Rooms��6   $��Center=�6(   $��Center=�6E   
�������$��20(�6t   $��20,2,0,0q�6�   $��43��6�   5'      5(      �� 5)   
   -   5        $	 button_Copy3��5)      $
��Left=�6'   $��371.921,212,0,0q�6B   $	��Top=�6[   $	��296��6s   $	��103��6   ���	#FF4A67E0$��2��6�   .��5*      �� $	��236��6   $ 
Horizontal=�6%   $��64��6>   .+�5+      �� $��images/item.png��6   $��52��61   $��
40,2,0,0.2q�6<   �� 5,      $��Items��6   $��Center=�6(   $��Center=�6E   
�������$��20(�6t   $��20,2,0,0q�6�   $��43��6�   5-      5.      �� 5/   
   -   5        $	 button_Copy4��5/      $
��Left=�6'   $��371.921,361,0,0q�6B   $	��Top=�6[   $	��296��6s   $	��103��6   ���	#FF4A67E0$��2��6�   .��50      �� $	��236��6   $ 
Horizontal=�6%   $��64��6>   .+�51      �� $��images/cost.png��6   $��52��61   $��
30,2,0,0.2q�6<   �� 52      $��Cost Centres��6   $��Center=�6/   $��Center=�6L   
�������$��20(�6{   $��10,2,0,0q�6�   $��43��6�   53      54      �� 55   
   -   5        $	 button_Copy5��55      $
��Left=�6'   $��371.921,522,0,0q�6B   $	��Top=�6[   $	��296��6s   $	��103��6   ���	#FF4A67E0$��2��6�   .��56      �� $	��236��6   $ 
Horizontal=�6%   $��64��6>   .+�57      �� $��images/icon.png��6   $��52��61   $��
30,2,0,0.2q�6<   �� 58      $��Transaction��6   $��Center=�6.   $��Center=�6K   
�������$��20(�6z   $��10,2,0,0q�6�   $��43��6�   59      5:      �� 5;   
   -	   5        $	 button_Help��5;      $
��Left=�6&   $��197,654,0,0q�6A   $	��Top=�6V   $	��177��6n   $��89��6z   ���	#FF4A67E0$��2��6�   .��5<      �� $��86��6   $ 
Horizontal=�6$   $��64��6=   .+�5=      �� $
��Help��6   $��Right=�6'   $��Center=�6C   
�������$��20(�6r   $��
20,12,0,10q�6�   $��42��6�   $ 1.181,0.372&�6�   z�5>      V� 5?      .~�5@      �� �� 5A      �� 5B      
 �� Angle$
 -2.754Q�6.   T� 5C      5D      5F      5G      5H      5J      5K      