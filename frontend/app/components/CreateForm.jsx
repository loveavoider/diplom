import {Tabs, Tab, TabPanels, TabPanel, TabList, Box, Button} from "@chakra-ui/react";

import Options from "@/app/components/create/Options";
import Anketa from "@/app/components/create/Anketa";
import Scoring from "@/app/components/create/Scoring";
import {useEffect, useState} from "react";
import Documents from "@/app/components/create/Documents";
import Link from "next/link";
import {sendGet} from "@/app/util/axios";

function getOptionsData(jurData) {
    return {value: jurData.value};
}

async function makePayload(id, setUnResulted) {
    const {status} = await sendGet(`makeBg/${id}`, true);
    setUnResulted(status !== 200);
}

async function updateDocs(setDocs, id) {
    const {data} = await sendGet(`doc/${id}`, true);
    setDocs(data);
}

async function dropApp(id, setUnResulted) {
    const {status} = await sendGet(`drop/${id}`, true);
    setUnResulted(status !== 200);
}

export default function CreateForm({ id, jurData, defaultFormData,
                                       propPurchase = {}, isCreate = true, isBank })
{
    const optionsData = getOptionsData(jurData);

    defaultFormData.inn = jurData.data.inn;
    defaultFormData.title = optionsData.value;

    const [formData, setFormData] = useState(defaultFormData);

    const [docsData, setDocsData] = useState([]);

    const [unResulted, setUnResulted] = useState(true);

    return (
        <Box p="40px" display="flex" justifyContent="center">
            <Box position="absolute" top="40px" right="80px">
                <Link href={'/'}>
                    <Button colorScheme="blue">На главную</Button>
                </Link>
                {
                    unResulted && isBank && defaultFormData.tab !== 3 ?
                        <>
                            <Button ml="10px" colorScheme="green" onClick={() => makePayload(id, setUnResulted)}>
                                Сформировать предложение
                            </Button>
                            <Button ml="10px" colorScheme="red" onClick={() => dropApp(id, setUnResulted)}>
                                Отклонить заявку
                            </Button>
                        </>
                        : ''
                }
            </Box>
            <Tabs variant='enclosed' w="60%" mt="40px">
                <TabList>
                    <Tab>Параметры</Tab>
                    <Tab>Анкета</Tab>
                    <Tab>Скоринг</Tab>
                    {
                        !isCreate ? <>
                            <Tab onClick={() => updateDocs(setDocsData, id)}>Документы</Tab>
                        </> : ''
                    }
                </TabList>
                <TabPanels>
                    <TabPanel>
                        <Options optionsData={optionsData} formData={formData} setFormData={setFormData}
                             propPurchase={propPurchase} isCreate={isCreate}/>
                    </TabPanel>
                    <TabPanel>
                        <Anketa jurData={jurData} />
                    </TabPanel>
                    <TabPanel>
                        <Scoring tab={defaultFormData.tab} formData={formData} isCreate={isCreate} />
                    </TabPanel>
                        <TabPanel><Documents docs={docsData} /></TabPanel>
                </TabPanels>
            </Tabs>
        </Box>
    );
}