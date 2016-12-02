import urllib3 # Using librabries .....

request_handle = urllib3.PoolManager()

#	A JSON API for getting latest Bitcoin prices
data_request = request_handle.request('GET', 'http://api.coindesk.com/v1/bpi/currentprice.json')

print data_request.status # Whether the request is pass or fail

if data_request.status == 200: # Request for data is fulfilled.

	print data_handle.data 	  # Output the prices for current Bitcoins prices as per API
else:
	print 'Error Getting data!' # Request status unsuccessful display theis error msg
