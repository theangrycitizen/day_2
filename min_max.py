#Minimum & Maximum Number from a Test list

def find_max_min(test_list):
 	test_list.sort()
 	if test_list[0] == test_list[-1]:
 		return [len(test_list)]
 	else:
 		return [test_list[0], test_list[-1]]
