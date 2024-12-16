# Log Module

 - Custom module: Magento_LogModule

 - Controller class : Magento\LogModule\Controller\Index\Index

 - Setup a custom log file in di.xml : Magento\LogModule\etc\di.xml

 - Log data as a string | Array: Magento\LogModule\Controller\Index\Index

 - Track the O/P: var/log/track_log_file.log


-------------- 


Use virtual types to log debug messages into a custom log file

1. Inject the MyCustomLogger virtual type in the Magento\LogModule\Controller\Index\Index object:
   
   ```<type name="Magento\LogModule\Controller\Index\Index">
     <arguments>
          <argument name="logger" xsi:type="object">MyCustomLogger</argument>
      </arguments>
    </type>```
 
2. Define the handler (Magento\LogModule\Model\MyCustomDebug) in a virtual type with a unique name:

    ```<virtualType name="MyCustomLogger" type="Magento\Framework\Logger\Monolog">
        <arguments>
            <argument name="name" xsi:type="string">logModule</argument>
            <argument name="handlers" xsi:type="array">
                <item name="system" xsi:type="object">Magento\LogModule\Model\MyCustomDebug</item>
            </argument>
        </arguments>
    </virtualType>```

3. In the di.xml file of your module, define a custom log file as a virtual type:

 ```<virtualType name="Magento\LogModule\Model\MyCustomDebug" type="Magento\Framework\Logger\Handler\Base">
        <arguments>
            <argument name="fileName" xsi:type="string">/var/log/track_log_file.log</argument>
        </arguments>
    </virtualType>```


--------------


File: Magento\LogModule\Controller\Index\Index

  // Log a string
 
  $this->logger->info('This is a custom log message.’);

  Output: [2024-12-16T03:35:52.833821+00:00] logModule.INFO: This is a custom log message. [] []


  // Log an array
 
  $data = ['key1' => 'value1', 'key2' => 'value2'];
  $serializedData = $this->serializer->serialize($data); // Serialize the Data
  $this->logger->info('Serialized Data: ' . $serializedData); // Log the Serialized Data


  Output: [2024-12-16T03:35:52.835063+00:00] logModule.INFO: Serialized Data: {"key1":"value1","key2":"value2"} [] []