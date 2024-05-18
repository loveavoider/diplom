import {Tabs, Tab, TabPanels, TabPanel, TabList, Box} from "@chakra-ui/react";

import Options from "@/app/components/create/Options";
import Anketa from "@/app/components/create/Anketa";
import Scoring from "@/app/components/create/Scoring";
import {useState} from "react";

function getOptionsData(jurData) {
    return {value: jurData.value};
}

export default function CreateForm({ jurData, defaultFormData, propPurchase = {}, isCreate = true }) {
    const optionsData = getOptionsData(jurData);

    defaultFormData.inn = jurData.data.inn;
    defaultFormData.title = optionsData.value;

    const [formData, setFormData] = useState(defaultFormData);

    return (
        <Box p="40px" display="flex" justifyContent="center">
            <Tabs variant='enclosed' w="60%" mt="40px">
                <TabList>
                    <Tab>Параметры</Tab>
                    <Tab>Анкета</Tab>
                    <Tab>Скоринг</Tab>
                    <Tab>Документы</Tab>
                    <Tab>Предложение банка</Tab>
                </TabList>
                <TabPanels>
                    <TabPanel>
                        <Options optionsData={optionsData} formData={formData} setFormData={setFormData}
                             propPurchase={propPurchase} />
                    </TabPanel>
                    <TabPanel>
                        <Anketa jurData={jurData} />
                    </TabPanel>
                    <TabPanel>
                        <Scoring formData={formData} isCreate={isCreate} />
                    </TabPanel>
                    <TabPanel>
                        <p>one!</p>
                    </TabPanel>
                    <TabPanel>
                        <p>one!</p>
                    </TabPanel>
                </TabPanels>
            </Tabs>
        </Box>
    );
}